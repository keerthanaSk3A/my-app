<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Page Title</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <style>
            .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
            }
            .pagination button {
                margin: 0 5px;
            }
        </style>
    </head>
    <body>

        <h1>Handset View</h1>
        <p>This is the handset view page.</p>

        <h5>Version 1.0.0</h5>
        <i><b>Filter</b></i>

        <div class="col-md-3">
            <div class="form-group">
                <label for="brand">Brand</label>
                <select class="form-control" id="brand" name="brand">
                    <option value="">Select Brand</option>
                    <option value="Apple">Apple</option>
                    <option value="OnePlus">OnePlus</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Google">Google</option>
                    <option value="Nokia">Nokia</option>
                    <option value="Sony">Sony</option>
                    <option value="LG">LG</option>
                    <option value="Huawei">Huawei</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="min_price">Min Price</label>
                <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Enter minimum price">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="max_price">Max Price</label>
                <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Enter maximum price">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="features">Features</label>
                5G<input type="checkbox" class="form-control" value="5G">
                Bluetooth<input type="checkbox" class="form-control" value="Bluetooth">
                NFC<input type="checkbox" class="form-control" value="NFC">
                Dual SIM<input type="checkbox" class="form-control" value="Dual SIM">
                Wireless Charging<input type="checkbox" class="form-control" value="Wireless Charging">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="search_item">Search</label>
                <input type="text" class="form-control" id="search_item" name="search_item" placeholder="Enter search term">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="searchBtn">Apply Filters</button>


        <hr>

        <div id="handsetResults">
            <!-- Handset results will be displayed here -->
        </div>


        <div class="pagination">
            <button id="prevPage" class="btn btn-secondary">Previous</button>
            <span id="currentPage">1</span>
            <button id="nextPage" class="btn btn-secondary">Next</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            //get params from url
            function params(currentPage = 1) {
                const features = [];

                $('input[type=checkbox]:checked').each(function() {
                    features.push($(this).val());
                });

                return {
                    brand: $('#brand').val(),
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    features: features,
                    search: $('#search_item').val(),
                    page: currentPage
                }
            }

            //render results
            function appendResults(data) {
                $('#handsetResults').empty();

                console.log('Appending results:');
                console.log(data);
                if (!data || data.length === 0) {
                    $('#handsetResults').append('<p>No handsets found.</p>');
                    return;
                }

                let html = '<table style="width:100%; border:1px solid black;border-collapse:collapse;"><thead style="border:1px solid black;border-collapse:collapse;"><tr style="border:1px solid black;border-collapse:collapse;"><th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th>Release Date</th><th>Features</th></tr></thead><tbody>';
                data.forEach(function(handset) {
                    html += `<tr style="border:1px solid black">
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.id}</td>
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.name}</td>
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.brand}</td>
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.price}</td>
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.release_date}</td>
                        <td style="border:1px solid black; border-collapse:collapse;">${handset.features.join(', ')}</td>
                    </tr>`;
                });
                html += '</tbody></table>';
                $('#handsetResults').append(html);

                //pagination

                let paginationHtml = '';
                if (data.current_page > 1) {
                    $('#prevPage').show();
                } else {
                    $('#prevPage').hide();
                }

            }

            //load handsets on page load
            function listHandsets (currentPage = 1) {
                const paramsData = params(currentPage);

                $.ajax({
                    url: '/api/v1/handsets',
                    method: 'GET',
                    data: paramsData,
                    success: function(response) {
                        console.log(response);
                        appendResults(response.data);
                    },
                    error: function(error) {
                        console.log(error);
                        $('#handsetResults').html('<p>No handsets found.</p>');
                        $('#pagination').empty('');
                    }
                });
            }


            $('#searchBtn').on('click', function() {
                listHandsets(1);
            });

            $(document).ready(function() {
                listHandsets(1);
            });


        </script>
    </body>
</html>
