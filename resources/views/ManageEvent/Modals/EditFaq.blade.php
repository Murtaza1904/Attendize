<div role="dialog" class="modal fade" style="display: none;">
    <form method="POST" action="{{ route('postEditEventFaq', ['event_id' => $event->id, 'faq_id' => $faq->id]) }}"
        accept-charset="UTF-8" class="ajax">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">
                        <i class="ico-question"></i>
                        Edit FAQ
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="question" class="form-label">Question <sup class="text-danger">*</sup></label>
                                <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}"
                                    placeholder="ex: this is a question" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="answer" class="form-label">Answer <sup class="text-danger">*</sup></label>
                                <input type="text" name="answer" id="answer" class="form-control" value="{{ $faq->answer }}"
                                    placeholder="ex: this is an answer" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close btn-danger" data-dismiss="modal" type="button">Cancel</button>
                    <input class="btn btn-success" type="submit" value="Edit FAQ">
                </div>
            </div>
        </div>
    </form>
</div>
