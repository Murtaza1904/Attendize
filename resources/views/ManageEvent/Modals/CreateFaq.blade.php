<div role="dialog" class="modal fade" style="display: none;">
    <form method="POST" action="{{ route('postCreateEventFaq', ['event_id' => $event->id]) }}"
        accept-charset="UTF-8" class="ajax">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">
                        <i class="ico-question"></i>
                        CREATE FAQ
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="question" class="form-label">Question <sup class="text-danger">*</sup></label>
                                <input type="text" name="question" id="question" class="form-control"
                                    placeholder="ex: this is a question" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="answer" class="form-label">Answer <sup class="text-danger">*</sup></label>
                                <input type="text" name="answer" id="answer" class="form-control"
                                    placeholder="ex: this is an answer" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close btn-danger" data-dismiss="modal" type="button">Cancel</button>
                    <input class="btn btn-success" type="submit" value="Create FAQ">
                </div>
            </div>
        </div>
    </form>
</div>
