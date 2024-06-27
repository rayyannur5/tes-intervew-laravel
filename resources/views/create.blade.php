@extends('layouts.main')
@section('container')
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold">Create Spko</h1>
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ url('/') }}">Spko</a></li>
                <li>Create</li>
            </ul>
        </div>
    </div>
    <div class="divider"></div>

    <form action="{{ url("/create") }}" method="post" id="create-form">
        @csrf
        <div class="card bg-base-100 overflow-auto p-4 mt-4">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Employee</span>
                </div>
                <select class="select select-bordered" id="select-employee" name="id_employee">
                    <option disabled selected>Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id_employee }}">{{ $employee->nama }}</option>
                    @endforeach
                </select>
                <div class="label hidden" id="validate-employee">
                    <span class="label-text-alt text-red-500">The employee field is required</span>
                </div>
                <div class="label mt-2">
                    <span class="label-text">Remarks</span>
                </div>
                <textarea class="textarea textarea-bordered" name="remarks" placeholder="remarks"></textarea>


                <div class="label mt-2">
                    <span class="label-text">Process</span>
                </div>
                <select class="select select-bordered" id="select-process" name="process">
                    <option disabled selected>Select Process</option>
                    @foreach ($process as $item_process)
                        <option value="{{ $item_process }}">{{ $item_process }}</option>
                    @endforeach
                </select>
                <div class="label hidden" id="validate-process">
                    <span class="label-text-alt text-red-500">The process field is required</span>
                </div>

                <div class="flex mt-4 justify-between">
                    <div class="label">
                        <span class="label-text">Products</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" onclick="modal_add_products.showModal()">add product</button>
                </div>

                <input id="input-product" type="text" value="" name="products" hidden>

                <div class="divider mt-0"></div>
                <div class="label hidden" id="validate-product">
                    <span class="label-text-alt text-red-500">The product field is required</span>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_section">
                    </tbody>
                </table>
            </label>
        </div>

        <div class="flex mt-2 gap-2 justify-end">
            <button class="btn btn-sm btn-success" type="submit">Save</button>
            <a href="{{ url('/') }}">
                <button class="btn btn-sm btn-warning" type="button">Cancel</button>
            </a>
        </div>
    </form>



    <dialog id="modal_add_products" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Select Products</h3>
            <div class="flex flex-col gap-2 my-4">
                @foreach ($products as $product)
                    <button onclick="addProduct('{{ $product->id_product }}')"
                        class="btn justify-start bg-base-200 rounded">{{ $product->serial_no }} |
                        {{ $product->description }}</button>
                @endforeach
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn btn-error text-neutral-content">Close</button>
                </form>
            </div>
        </div>
    </dialog>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const products = @json($products);
        var product_selected = [];

        function addProduct(idProduct) {
            modal_add_products.close()

            $('#validate-product').addClass('hidden')

            const product = products.filter(p => p.id_product == idProduct)[0];

            const check = product_selected.filter(p => p.id_product == idProduct)

            if (check.length == 0) {
                product.qty = 1
                product_selected.push(product)
            } else {
                product_selected.forEach(p => {
                    if (p.id_product == idProduct) {
                        p.qty += 1
                    }
                })
            }
            console.log(product_selected)
            updateHtml()
        }

        function updateHtml() {
            let html = ""

            product_selected.forEach((p, index) => {
                html += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${p.description}</td>
                        <td>${p.qty}</td>
                        <td>
                            <button class="btn btn-xs btn-warning" onclick="decrementProduct(${p.id_product})">-</button>    
                            <button class="btn btn-xs btn-success" onclick="incrementProduct(${p.id_product})">+</button>    
                            <button class="btn btn-xs btn-error" onclick="deleteProduct(${p.id_product})">x</button>    
                        </td>
    
                    </tr>
                `
            });

            $('#product_section').html(html);
        }

        function incrementProduct(idProduct) {
            product_selected.forEach((p, index) => {
                if (p.id_product == idProduct) {
                    p.qty++
                    updateHtml()
                }
            })
        }

        function decrementProduct(idProduct) {
            product_selected.forEach((p, index) => {
                if (p.id_product == idProduct) {
                    if (p.qty == 1) {
                        product_selected.splice(index, 1)
                    } else {
                        p.qty--
                    }
                    updateHtml()
                }
            })
        }

        function deleteProduct(idProduct) {
            product_selected.forEach((p, index) => {
                if (p.id_product == idProduct) {
                    product_selected.splice(index, 1)
                    updateHtml()
                }
            })
        }


        $('#create-form').submit(function(event) {
            let validate = true
            const employee = $('#select-employee').val()
            const process = $('#select-process').val()

            if (employee == null) {
                validate = false
                $('#validate-employee').removeClass('hidden')
            } else {
                $('#validate-employee').addClass('hidden')
            }

            if (process == null) {
                validate = false
                $('#validate-process').removeClass('hidden')
            } else {
                $('#validate-process').addClass('hidden')
            }

            if (product_selected.length == 0) {
                validate = false
                $('#validate-product').removeClass('hidden')
    
            } else {
                const id_products = product_selected.map(p => ({
                    "id" : p.id_product,
                    "qty": p.qty
                }))
    
                $('#input-product').val(JSON.stringify(id_products)) 
                $('#validate-product').addClass('hidden')
            }

            if(!validate){
                event.preventDefault()
            }
        });
    </script>
@endsection
