<div role="dialog" class="modal fade" style="display: none;">
    <form method="POST" action="{{ route('postCreateEventDiscountCode', ['event_id' => $event->id]) }}"
        accept-charset="UTF-8" class="ajax">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">
                        <i class="ico-ticket"></i>
                        CREATE DISCOUNT CODE
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code" class="form-label">Code <sup class="text-danger">*</sup></label>
                                <input type="text" name="code" id="code" class="form-control"
                                    placeholder="ex: SUMMER2024" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_percentage" class="form-label">Discount Percentage <sup class="text-danger">*</sup></label>
                                <input type="number" name="discount_percentage" id="discount_percentage" class="form-control"
                                    min="0" placeholder="ex: 30" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="limit" class="form-label">Limit <sup class="text-danger">*</sup></label>
                                <input type="number" name="limit" id="limit" class="form-control"
                                    min="0" placeholder="ex: 10" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiry_date" class="form-label">Expiry Date <sup class="text-danger">*</sup></label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="ex: 2024-06-15" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close btn-danger" data-dismiss="modal" type="button">Cancel</button>
                    <input class="btn btn-success" type="submit" value="Create Discount Code">
                </div>
            </div>
        </div>
    </form>
</div>
