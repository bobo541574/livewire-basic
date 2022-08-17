<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;
use App\Models\Containent;

class CascadingDropdown extends Component
{
    public $containents = [];
    public $countries = [];
    public $selectedContainent = [
        "name"  => "",
        "id"    => null
    ];
    public $selectedCountries = [];
    public $search = "";

    public function mount()
    {
        // $this->search();

        // $this->containents = Containent::all();   
    }

    public function changeContainent($containent)
    {
        $this->search = "";
        if ($containent && $containent['id'] !== $this->selectedContainent['id']) {
            $this->selectedContainent = $containent;
            $this->countries = Country::where('containent_id', data_get($containent, 'id', null))->get();
        } else {
            $this->selectedContainent = [
                "name"  => "",
                "id"    => null
            ];
            $this->countries = [];
        }
    }

    public function getSelectedContainentName()
    {
        return $this->selectedContainent ? $this->selectedContainent['name'] : null;
    }

    public function getSelectedContainentId()
    {
        return $this->selectedContainent ? $this->selectedContainent['id'] : null;
    }

    public function changeCountry($country)
    {
        if ($country && !in_array($country['id'], $this->getSelectedCountryIds())) {
            $this->selectedCountries[] = $country;
        } else {
            $this->selectedCountries = collect($this->selectedCountries)->filter(function ($c) use ($country) {
                return $c['id'] !== $country['id'];
            })->toArray();
        }
    }

    public function getSelectedCountryName()
    {
        $name = null;

        if (count($this->selectedCountries) > 0) {
            $name = collect($this->selectedCountries)->map(function ($country) {
                return data_get($country, 'name', null);
            })->join(", ");
        }

        return $name;
    }

    public function getSelectedCountryIds()
    {
        return $this->selectedCountries ? collect($this->selectedCountries)->pluck('id')->toArray() : [];
    }

    public function search()
    {
        $this->containents = [];

        $this->containents = Country::select('id', 'name')
                                ->where('name', 'like', "%" . $this->search . "%")
                                ->orderBy('name')->take(50)->get();
    }

    public function updated()
    {
        // $this->search();
    }

    public function render()
    {
        $this->search();

        return view('livewire.cascading-dropdown');
    }
}
