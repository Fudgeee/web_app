@extends('layout')
@section('content')
       
    <div class="container pb-4">
        <h1 class="py-3 max-width-fit-content float-start">List of Countries</h1>
        <input type="text" id="searchInput" class="form-control mb-3 width-100 float-end py-2 my-4" placeholder="&#128269; Search country...">
        <hr class="clear-both me-2">
        <div id="countryList" class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            @foreach($countries->take(30) ?? '' as $country)
                <div class="col mb-3 country-item">
                    <a href="{{ route('country.detail', $country->id) }}" class="text-decoration-none fw-semibold d-block p-3 background-color-white border rounded-lg font-size-14 black">
                        <img src="{{ $country->flag }}" class="img-fluid height-25 width-35 me-2 border-1-solid-black" alt="{{ $country->name }} Flag" style="max-width: 50px; height: auto;"> {{ $country->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <button id="showAllButton" onclick="showAllCountries()" class="btn btn-primary mx-auto py-2 px-3">Show All Countries</button>
        </div>
    </div>

    
    <script>
        var showAllCountriesClicked = false;

        function showAllCountries() {
            var countryList = document.getElementById('countryList');
            var showAllButton = document.getElementById('showAllButton');
            var countries = document.getElementsByClassName('country-item');
                
            showAllCountriesClicked = true;

            // Show all countries
            @foreach($countries->skip(30) ?? [] as $country)
                var listItem = document.createElement('div');
                listItem.className = 'col mb-3 country-item';
                var link = document.createElement('a');
                link.className = 'text-decoration-none fw-semibold d-block p-3 background-color-white border rounded-lg font-size-14 black';
                link.href = '{{ route('country.detail', $country->id) }}';
                link.innerHTML = '<img src="{{ $country->flag }}" class="img-fluid height-25 width-35 me-2 border-1-solid-black" alt="{{ $country->name }} Flag">{{ $country->name }}';
                listItem.appendChild(link);
                countryList.appendChild(listItem);
            @endforeach

            if (showAllButton) {
                showAllButton.style.display = 'none';
            }
        }

        // Function for filtering the list of countries
        function filterCountries() {
            
            if (!showAllCountriesClicked) {
                showAllCountries();
                showAllCountriesClicked = true;
            }

            var input = document.getElementById('searchInput');
            var filter = input.value.toUpperCase();
            var countries = document.getElementsByClassName('country-item');

            // Go through each country and hide the ones that don't match the search term
            for (var i = 0; i < countries.length; i++) {
                var countryName = countries[i].textContent.toUpperCase();
                if (countryName.indexOf(filter) > -1) {
                    countries[i].style.display = '';
                }
                else {
                    countries[i].style.display = 'none';
                }
            }
        }

        // Event listener for the search field
        document.getElementById('searchInput').addEventListener('keyup', filterCountries);
    </script>
@endsection