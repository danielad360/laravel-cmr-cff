@extends('layouts.admin')

@section('main-content')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
    <!-- Page Heading -->
    @if(Route::is('products.edit'))
        <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Product') }}</h1>
    @else
        <h1 class="h3 mb-4 text-gray-800">{{ __('Add new Product') }}</h1>
    @endif

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

        <div class=" justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4 ">

                <form action="@if(Route::is('products.edit')){{ route('products.update', $product->id) }}@else{{ route('products.store') }}@endif" method="POST" class="mx-5 my-5" enctype="multipart/form-data">
                    @csrf
                    @if(Route::is('products.edit'))
                        @method('PUT')

                    @endif
                    @if(Route::is('products.edit'))

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <img src="/image/{{ $product->image }}" width="250px">
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="inputProductName" class="col-2 col-form-label">Name</label>
                        <div class="col-auto">
                            @if(Route::is('products.edit'))
                            <input type="text" class="form-control" name="name" id="inputProductName" placeholder="Product Name" value="{{$product->name}}" required>
                            @else
                                <input type="text" class="form-control" name="name" id="inputProductName" placeholder="Product Name" required>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputProductPrice" class="col-2 col-form-label">Price</label>
                        <div class="col-auto">
                            @if(Route::is('products.edit'))
                                <input type="number" step="0.01" class="form-control" name="price" id="inputProductPrice" placeholder="Product price" value="{{$product->price}}" required>
                            @else
                                <input type="number" step="0.01" class="form-control" name="price" id="inputProductPrice" placeholder="Product price"  required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputProductName" class="col-2 col-form-label">Notes</label>
                        <div class="col-4">
                            @if(Route::is('products.edit'))
                                <textarea class="form-control" row="5"  name="inputText" id="inputText">{{$product->notes}}</textarea>
                            @else
                                <textarea class="form-control" row="5" name="inputText" id="inputText"></textarea>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-4">
                            @if(Route::is('products.edit'))

                                <input type="file" name="image" class="form-control" src="/images/{{$product->image}}" placeholder="image">
                            @else
                                <input type="file" name="image" class="form-control" placeholder="image">

                            @endif

                        </div>
                    </div>
            <hr class="my-5" />
                    <h4>Product Parts</h4>
                    <div class="row">
                    <div class="col-sm-2">Quantity</div>

                    <div class="col-sm-2"></div>
                    <div class="col-sm-4"></div>
                    </div>
                    @foreach($parts as $part)
                    <input type="hidden"  value="{{$part->id}}" name="id[]" />
                    <div class="form-group row cloneRow">
                        <div class="col-sm-2 d-flex align-items-center">
                            <input type="number" step="1" class="form-control" name="partquantity[]" id="partquantity" value="0" required>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center">
                            <h5 id="partnames" type="text" name="partnames[]" placeholder="Part Name" value="">{{$part->name}}</h5>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center">
                            <img width="100px" src="/image/{{$part->image}}">
                        </div>


                    </div>


                @endforeach
                    <div class="form-group row">
                        <div class="col-sm-10">
                            @if(Route::is('products.edit'))
                                <button type="submit" class="btn btn-primary ">Edit Product</button>
                            @else
                                <button type="submit" class="btn btn-primary ">Add new Product</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <script>
        let getButton = document.querySelector('.addNewButton');
        getButton.addEventListener('click', () =>{
            createNewElement();
            removeElement();
        })
    function createNewElement(){
        let getCloneRow = document.querySelector('.cloneRow');
        console.log(getCloneRow)
        let clone = getCloneRow.cloneNode(true)
        // clone.children[1].firstElementChild.disabled = true;
        clone.lastElementChild.innerHTML = "<button type='button' class='btn btn-danger removeThisItem'> X </button>"
        getCloneRow.after(clone);
        getCloneRow.children[1].firstElementChild.value = "";

    }

    function removeElement(){
            let getAllButtons = document.querySelectorAll('.removeThisItem');
            getAllButtons.forEach(item =>{
                item.addEventListener('click', () =>{
                    item.parentElement.parentElement.remove();
                })
            })
        }
    </script>

    @php
    $arrayWithPartsList = [];
foreach($parts as $part){
	array_push($arrayWithPartsList, $part->name);
}

    @endphp
    <script>
    function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) { return false;}
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arr.length; i++) {
    /*check if the item starts with the same letters as the text field value:*/
    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
    /*create a DIV element for each matching element:*/
    b = document.createElement("DIV");
    /*make the matching letters bold:*/
    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
    b.innerHTML += arr[i].substr(val.length);
    /*insert a input field that will hold the current array item's value:*/
    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
    /*execute a function when someone clicks on the item value (DIV element):*/
    b.addEventListener("click", function(e) {
    /*insert the value for the autocomplete text field:*/
    inp.value = this.getElementsByTagName("input")[0].value;
    /*close the list of autocompleted values,
    (or any other open lists of autocompleted values:*/
    closeAllLists();
    });
    a.appendChild(b);
    }
    }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
    /*If the arrow DOWN key is pressed,
    increase the currentFocus variable:*/
    currentFocus++;
    /*and and make the current item more visible:*/
    addActive(x);
    } else if (e.keyCode == 38) { //up
    /*If the arrow UP key is pressed,
    decrease the currentFocus variable:*/
    currentFocus--;
    /*and and make the current item more visible:*/
    addActive(x);
    } else if (e.keyCode == 13) {
    /*If the ENTER key is pressed, prevent the form from being submitted,*/
    e.preventDefault();
    if (currentFocus > -1) {
    /*and simulate a click on the "active" item:*/
    if (x) x[currentFocus].click();
    }
    }
    });
    function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
    }
    }
    function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
    }
    }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
    closeAllLists(e.target);
    });
    }

    /*An array containing all the country names in the world:*/
let countries = @json($arrayWithPartsList);
    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("partname"), countries);
    </script>


@endsection
