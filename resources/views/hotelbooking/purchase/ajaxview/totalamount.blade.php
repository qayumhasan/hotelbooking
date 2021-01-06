        <div class="col-md-12">
            <div class="form-group">
                <label for="fname">Total Amount: *</label>
                <input type="text" class="form-control totalamount" value="{{$mainamount}}" disabled>
                <input type="hidden" name="totalamount" class="form-control totalamount" value="{{$mainamount}}">
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fname">Paid: *</label>
                <input type="number" class="form-control paidamount" name="paidamount">
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fname">Due: *</label>
                <input type="text" class="form-control dueamount" value="{{$mainamount}}" disabled>
                <input type="hidden" class="form-control dueamount" name="dueamount" value="{{$mainamount}}">
            </div>
        </div>


