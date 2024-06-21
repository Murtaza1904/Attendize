var checkinApp = new Vue({
    el: '#app',
    data: {
        attendees: [],
        searchTerm: '',
        searchResultsCount: 0,
        showScannerModal: false,
        showCheckInModal: false,
        attendee_id: null,
        is_group: false,
        number_of_person: null,
        checking: null,
        number_of_attendees: null,
        number_of_children: null,
        note: null,
        checkinButton: true,
        checkoutButton: false,
        workingAway: false,
        isInit: false,
        errors: null,
        isScanning: false,
        videoElement: $('video#scannerVideo')[0],
        canvasElement: $('canvas#QrCanvas')[0],
        scannerDataUrl: '',
        QrTimeout: null,
        canvasContext: $('canvas#QrCanvas')[0].getContext('2d'),
        successBeep: new Audio('/mp3/beep.mp3'),
        scanResult: false,
        scanResultObject: {}
    },

    created: function () {
        this.fetchAttendees()
    },

    ready: function () {
    },

    methods: {
        fetchAttendees: function () {
            this.$http.post(Attendize.checkInSearchRoute, {q: this.searchTerm}).then(function (res) {
                this.attendees = res.data;
                this.searchResultsCount = (Object.keys(res.data).length);
                // console.log('Successfully fetched attendees')
            }, function () {
                console.log('Failed to fetch attendees')
            });
        },
        toggleCheckInModal: function (attendee) {
            this.$http.get('get-attendee-ticket/'+attendee.id).then(function (res) {
                this.is_group = res.data.attendee.ticket.number_of_person == 1 ? false : true;
                this.number_of_person = res.data.attendee.ticket.number_of_person;
                this.number_of_attendees = res.data.attendee.number_of_attendees;
                this.number_of_children = res.data.attendee.number_of_children;
                this.note = res.data.attendee.note;
                this.checkoutButton = res.data.attendee.ticket.number_of_days > 1 && res.data.attendee.has_arrived ? true : false;
                this.checkinButton = !this.checkoutButton;
            });
            this.showCheckInModal = true;
            this.attendee_id = attendee.id;
            this.checking = attendee.has_arrived ? 'out' : 'in';
            this.attendee = attendee;
        },
        toggleCheckin: function () {
            if(this.workingAway) {
                return;
            }
            this.workingAway = true;
            var that = this;


            var checkinData = {
                checking: this.checking,
                attendee_id: this.attendee_id,
                number_of_attendees: this.number_of_attendees,
                number_of_children: this.number_of_children,
                note: this.note,
            };

            this.$http.post(Attendize.checkInRoute, checkinData).then(function (res) {
                if (res.data.errors) {
                    this.errors = res.data.errors;
                }
                if (res.data.status == 'success' || res.data.status == 'error') {
                    if (res.data.status == 'error') {
                        alert(res.data.message);
                    }
                    this.attendee.has_arrived = checkinData.checking == 'out' ? 0 : 1;
                    this.showCheckInModal = false;
                    that.workingAway = false;
                } else {
                    that.workingAway = false;
                }
            });
        },
        clearSearch: function () {
            this.searchTerm = '';
            this.fetchAttendees();
        },

        /* QR Scanner Methods */

        QrCheckin: function (attendeeReferenceCode) {

            this.isScanning = false;

            this.$http.post(Attendize.qrcodeCheckInRoute, {attendee_reference: attendeeReferenceCode}).then(function (res) {
                this.successBeep.play();
                this.scanResult = true;
                this.scanResultObject = res.data;
                this.searchTerm = res.data.reference;
                this.fetchAttendees();

            }, function (response) {
                this.scanResultObject.message = lang("whoops2");
            });
        },

        showQrModal: function () {
            this.showScannerModal = true;
            this.initScanner();
        },

        initScanner: function () {

            var that = this;
            this.isScanning = true;
            this.scanResult = false;

            /*
             If the scanner is already initiated clear it and start over.
             */
            if (this.isInit) {
                clearTimeout(this.QrTimeout);
                this.QrTimeout = setTimeout(function () {
                    that.captureQrToCanvas();
                }, 500);
                return;
            }

            qrcode.callback = this.QrCheckin;

            // FIX SAFARI CAMERA
            if (navigator.mediaDevices === undefined) {
                navigator.mediaDevices = {};
            }

            if (navigator.mediaDevices.getUserMedia === undefined) {
                navigator.mediaDevices.getUserMedia = function(constraints) {
                    var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

                    if (!getUserMedia) {
                        return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                    }

                    return new Promise(function(resolve, reject) {
                        getUserMedia.call(navigator, constraints, resolve, reject);
                    });
                }
            }

            navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "environment"
                },
                audio: false
            }).then(function(stream) {
                that.stream = stream;

                if (that.videoElement.mozSrcObject !== undefined) { // works on firefox now
                    that.videoElement.mozSrcObject = stream;
                } else if(window.URL) { // and chrome, but must use https
                    that.videoElement.srcObject = stream;
                };
            }).catch(function(err) {
                console.log(err.name + ": " + err.message);
                alert(lang("checkin_init_error"));
            });

            this.isInit = true;
            this.QrTimeout = setTimeout(function () {
                that.captureQrToCanvas();
            }, 500);
            
        },
        /**
         * Takes stills from the video stream and sends them to the canvas so
         * they can be analysed for QR codes.
         */
        captureQrToCanvas: function () {

            if (!this.isInit) {
                return;
            }

            this.canvasContext.clearRect(0, 0, 600, 300);

            try {
                this.canvasContext.drawImage(this.videoElement, 0, 0);
                try {
                    qrcode.decode();
                }
                catch (e) {
                    console.log(e);
                    this.QrTimeout = setTimeout(this.captureQrToCanvas, 500);
                }
            }
            catch (e) {
                console.log(e);
                this.QrTimeout = setTimeout(this.captureQrToCanvas, 500);
            }
        },
        closeScanner: function () {
            clearTimeout(this.QrTimeout);
            this.showScannerModal = false;
            track = this.stream.getTracks()[0];
            track.stop();
            this.isInit = false;
            this.fetchAttendees();
        }
    }
});
