<div class="modal fade editCountry" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Country</h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="edit">
                    <input type="hidden" wire:model="cid">
                    <div class="form-group">
                        <label for="">Continent</label>
                        <select class="form-control form-control-sm" wire:model="edit_continent">
                            <option value="">No Selected</option>
                            @foreach($continents as $continent)
                            <option value="{{$continent->id}}">{{$continent->continent_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('edit_continent') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="">Country Name</label>
                        <input type="text" class="form-control" placeholder="Country Name" wire:model="edit_country_name">
                        <span class="text-danger">@error('edit_country_name') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="">Capital City</label>
                        <input type="text" class="form-control" placeholder="Capital City" wire:model="edit_capital_city">
                        <span class="text-danger">@error('edit_capital_city') {{$message}} @enderror</span>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>