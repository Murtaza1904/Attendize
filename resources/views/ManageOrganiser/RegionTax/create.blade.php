<div class="modal fade" id="regionTaxCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <form method="POST" action="{{ route('region-taxes.store', $organiser->id) }}" accept-charset="UTF-8"
            class="">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3 class="modal-title">
                            <i class="ico-calendar"></i>
                            Create Region Tax
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="region" class="control-label required">Region</label>
                                    <input type="text" class="form-control" placeholder="Enter region name"
                                        name="region" id="region" required>
                                        @error('region')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tax_type" class="control-label required">Tax Type</label>
                                    <select class="form-control"
                                        name="tax_type" id="tax_type" required>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                    @error('tax_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tax" class="control-label required">Tax</label>
                                    <input type="number" class="form-control" placeholder="Enter tax value"
                                        step="any" name="tax" id="tax" required>
                                    @error('tax')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="payment_gateway" class="control-label required">Payment Gateway</label>
                                    <select class="form-control" name="payment_gateway" id="payment_gateway" required>
                                        <option value="" selected disabled>Select payment gateway</option>
                                        <option value="Stripe CA">Stripe CA</option>
                                        <option value="Stripe USA">Stripe USA</option>
                                    </select>
                                    @error('payment_gateway')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="uploadProgress"></span>
                        <button class="btn modal-close btn-danger" data-dismiss="modal" type="button">Cancel</button>
                        <input class="btn btn-success" type="submit" value="Create Region Tax">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
