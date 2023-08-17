<div class="modal fade addCountry" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Country</h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label for="">Continent</label>
                        <select class="form-control form-control-sm" wire:model="continent">
                            <option value="">No Selected</option>
                            @foreach($continents as $continent)
                            <option value="{{$continent->id}}">{{$continent->continent_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('continent') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="">Country Name</label>
                        <input type="text" class="form-control" placeholder="Country Name" wire:model="country_name">
                        <span class="text-danger">@error('country_name') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="">Capital City</label>
                        <input type="text" class="form-control" placeholder="Capital City" wire:model="capital_city">
                        <span class="text-danger">@error('capital_city') {{$message}} @enderror</span>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>