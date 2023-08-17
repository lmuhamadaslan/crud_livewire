<div>
    <div class="btn btn-primary btn-sm mb-3" wire:click="OpenModalAddCountry()">Add New Country</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Continent</th>
                <th scope="col">Country</th>
                <th scope="col">Capital City</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($countries as $country)
                <tr>
                    <td>{{$country->continent->continent_name}}</td>
                    <td>{{$country->country_name}}</td>
                    <td>{{$country->capital_city}}</td>
                    <td>
                        <div class="btn btn-sm btn-warning" wire:click="OpenModalUpdateCountry({{$country->id}})">Update</div>
                        <div class="btn btn-sm btn-danger" wire:click="DeleteConfirm({{$country->id}})">Hapus</div>
                    </td>
                </tr>
                @empty
                    <code>No Country Found</code>
            @endforelse
        </tbody>
    </table>
    @include('modals.add-modal')
    @include('modals.edit-modal')
</div>