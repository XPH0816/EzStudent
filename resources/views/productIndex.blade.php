@extends('header')
@section('content')
    <style>
        .filter {
            box-sizing: border;
            width: 33.33%;
            display: none;
        }

        .show {
            display: block;
        }

        /* Style the buttons */
        .btn {
            border: none;
            outline: none;
            padding: 16px;
            /* background-color: #f1f1f1; */
            cursor: pointer;
        }

        .btn:hover {
            background-color: #ddd;
        }

        .btn.active {
            background-color: #666;
            color: white;
        }
    </style>
    <div class="container border login-border mt-5 centerIt">
        <div id="myBtnContainer">
            <button class="btn active " id="all" onclick="filterSelection('all')">Show all</button>
            <button class="btn" id="Men" onclick="filterSelection('Men')">Men</button>
            <button class="btn" id="Women" onclick="filterSelection('Women')">Women</button>
        </div>

        <div class="container">
            <div class="col mt-5">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="filter {{ $product->category }}">
                            <div class="row">
                                <div class="column">
                                    <a href="{{ route('product.show', $product->id) }}"><img src="{{ $product->image }}"
                                            class="img-fluid" alt="{{ $product->name }}"></a>
                                    <b>{{ $product->name }}</b>
                                    <p>RM {{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            filterSelection("all")

            function filterSelection(c) {
                var x, i;
                x = document.getElementsByClassName("filter");
                if (c == "all") {
                    c = "";
                }

                for (i = 0; i < x.length; i++) {
                    RemoveClass(x[i], "show");
                    if (x[i].className.indexOf(c) > -1)
                        AddClass(x[i], "show");
                }
            }

            function AddClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    if (arr1.indexOf(arr2[i]) == -1) {
                        element.className += " " + arr2[i];
                    }
                }
            }

            function RemoveClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    while (arr1.indexOf(arr2[i]) > -1) {
                        arr1.splice(arr1.indexOf(arr2[i]), 1);
                    }
                }
                element.className = arr1.join(" ");
            }

            // Add active class to the current button (highlight it)
            var btnContainer = document.getElementById("myBtnContainer");
            var btns = btnContainer.getElementsByClassName("btn");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                });
            }
        </script>
        @isset($category)
            <script>
                filterSelection('{{ $category }}')

                var button = document.getElementById("{{ $category ?? 'all' }}")

                button.click();

            </script>
        @endisset
    @endsection
