<?php

namespace App\Http\Livewire;

use App\Models\Continent;
use App\Models\Country;
use Livewire\Component;

class Countries extends Component
{
    public $country_name, $capital_city, $continent;
    public $edit_country_name, $edit_capital_city, $edit_continent, $cid;
    protected $listeners = ['delete','deleteCheckedCountries'];
    public $checkedCountry = [];
    public function render()
    {
        return view('livewire.countries', [
            'continents' => Continent::orderBy('continent_name', 'asc')->get(),
            'countries' => Country::orderBy('country_name', 'asc')->get()
        ]);
    }

    public function OpenModalAddCountry()
    {
        $this->continent = '';
        $this->country_name = '';
        $this->capital_city = '';
        $this->dispatchBrowserEvent('OpenModalAddCountry');
    }

    public function save()
    {
        // dd(
        //     $this->continent,
        //     $this->country_name,
        //     $this->capital_city,
        // );
        $this->validate([
            'continent' => 'required',
            'country_name' => 'required',
            'capital_city' => 'required'
        ]);

        $save = Country::insert([
            'continent_id' => $this->continent,
            'country_name' => $this->country_name,
            'capital_city' => $this->capital_city
        ]);

        if ($save) {
            $this->dispatchBrowserEvent('CloseModalAddCountry');
            $this->checkedCountry = [];
        }
    }

    public function OpenModalUpdateCountry($id)
    {
        $info = Country::find($id);
        $this->edit_continent = $info->continent_id;
        $this->edit_country_name = $info->country_name;
        $this->edit_capital_city = $info->capital_city;
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenModalUpdateCountry', [
            'id' => $id
        ]);
    }

    public function edit()
    {
        $id = $this->cid;
        // dd($this->edit_continent, $this->edit_country_name, $this->edit_capital_city, $this->cid);
        $this->validate([
            'edit_continent' => 'required',
            // maksudnya adalah, jika edit_country_name tidak sama dengan country_name yang ada di table countries, maka validasi unique akan dijalankan
            'edit_country_name' => 'required|unique:countries,country_name, ' . $id,
            'edit_capital_city' => 'required'
        ], [
            'edit_continent.required' => 'Continent field is required',
            'edit_country_name.required' => 'Country Name field is required',
            'edit_country_name.unique' => 'Country Name already exists',
            'edit_capital_city.required' => 'Capital City field is required'
        ]);

        $update = Country::find($id)->update([
            'continent_id' => $this->edit_continent,
            'country_name' => $this->edit_country_name,
            'capital_city' => $this->edit_capital_city
        ]);

        if ($update) {
            $this->dispatchBrowserEvent('CloseModalUpdateCountry');
            $this->checkedCountry = [];
        }
    }

    public function DeleteConfirm($id)
    {
        $info = Country::find($id);
        $this->dispatchBrowserEvent('SwalConfirm', [
            'title' => 'Are You Sure?',
            'html' => 'You want to delete <strong>' . $info->country_name . '</strong>',
            'id' => $id
        ]);
    }

    public function delete($id){
        $del = Country::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedCountry = [];
    }

    public function deleteCountries(){
        $this->dispatchBrowserEvent('swal:deleteCountries', [
            'title' => 'Are You Sure?',
            'html' => 'You want delete this countries',
            'checkedIDs' => $this->checkedCountry
        ]);
    }

    public function deleteCheckedCountries($ids){
        Country::whereKey($ids)->delete();
        $this->checkedCountry = [];
    }

    public function isChecked($countryId){
        return in_array($countryId, $this->checkedCountry) ? 'bg-info text-white' : '';
    }
}
