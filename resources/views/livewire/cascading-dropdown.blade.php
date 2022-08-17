<div>
    <div class="flex flex-row gap-6 w-[500px] mx-auto justify-between py-16">
        <div x-data="{ show: false }" class="flex-1 mt-1 relative">
            <button type="button" @click="show = true" class="bg-gray-100 relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                <span class="block truncate"> {{ $this->getSelectedContainentName() ?: 'Please select containent' }} </span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <div x-show="show" @click.outside="show = false" class="relative z-10 mt-1 w-full bg-gray-100 shadow-lg max-h-60 rounded-md py-1 text-base">
                <div class="flex mx-3 my-2 justify-center bg-gray-100 border-b-0 ring-1 rounded ring-gray-400">
                    <input type="text" wire:model.debounce.300ms="search" class="w-full bg-gray-100 ring-0 text-sm shadow border-none focus:outline-none focus:ring-0 rounded">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                    </span>
                </div>
                <ul class="absolute z-10 w-full bg-gray-100 shadow-lg max-h-40 rounded-b-md py-1 pl-3 pr-1 text-base ring-none overflow-auto focus:outline-none sm:text-sm">
                    @if (count($containents) > 0)
                        @foreach ($containents as $index => $containent)
                            <li @click.inside="show = false" wire:click="changeContainent({{ $containent }})" class="text-gray-900 cursor-default select-none relative rounded ml-1 pl-3 py-2  hover:bg-blue-200 {{ ($this->getSelectedContainentId() === $containent->id) ? 'bg-red-200' : '' }}" :id="{{ $containent->id }}">
                                <span class="font-normal block truncate"> {{ $containent->name }} </span>
                                @if ($this->getSelectedContainentId() === $containent->id)
                                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li class="text-gray-900 cursor-default select-none relative rounded ml-1 pl-3 py-2  hover:bg-blue-200" :id="'loading'">
                            <span class="font-normal block truncate"> No Data Found </span>
                        </li>
                    @endif
                    <li wire:loading class="text-gray-900 cursor-default select-none relative rounded ml-1 pl-3 py-2  hover:bg-blue-200" :id="'loading'">
                        <span class="font-normal block truncate"> Loading... </span>
                    </li>
                </ul>
            </div>
        </div>

        <div x-data="{ show: false }" class="flex-1 mt-1 relative">
            <div type="button" @click="show = true" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                <div class="block"> {{ $this->getSelectedCountryName() ?: 'Please select country' }} </div>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>

            @if ($this->getSelectedContainentId())
                <ul x-show="show" @click.outside="show = false" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                    @foreach ($countries as $country)
                    <li wire:click="changeCountry({{ $country }})" class="text-gray-900 cursor-default select-none relative m-1 rounded py-2 pl-3 pr-9 hover:bg-blue-200 {{ in_array($country->id, $this->getSelectedCountryIds()) ? 'bg-red-200' : '' }}" id="listbox-option-0" role="option">
                            <span class="font-normal block truncate"> {{ $country->name }} </span>
                            @if (in_array($country->id, $this->getSelectedCountryIds()))
                                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
