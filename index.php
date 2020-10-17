<?php

include_once "./include/header.php";
$cities = ["Changanassery", "Erattupetta", "Ettumanoor", "Kanjirappally", "Kottayam Town", "Manarcaud", "Pala", "Pampady", "Ponkunnam", "Puthuppally", "Ramapuram", "Teekoy", "Vaikam"];

?>

<h1 class="text-center" style="margin-top: 30px">Home Services</h1>
<hr>
<div class="container" style="margin-top:75px; margin-bottom: 60px;">


    <div class="row">
        <div class="form-group col-5">
            <label for=""><b><h4>City</h4></b></label>
            <select class="form-control" name="city" id="city">
                <option value="none">-- Select City --</option>
                <?php foreach ($cities as $city) : ?>
                <option value="<?= $city ?>"> <?= $city ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-5">
            <label for=""><b><h4>Who's Required</h4></b></label>
            <select class="form-control" name="profession" id="profession">
                <option value="none">Select Profession</option>
                <option value="Electrician">Electrician</option>
                <option value="Plumber">Plumbing</option>
                <option value="Cleaning and Disinfection">Cleaning and Disinfection</option>
                <option value="Home Nurse">Home Nurse</option>
                <option value="Pest Control">Pest Control</option>
            </select>
        </div>

        <div class="form-group col-2">
            <label for-""></label>
            <button id="search" class="form-control btn btn-success" type="button">Search</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="providers" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Profession</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='5'>Provider Details are displayed here.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="js/jquery.js"></script>
<script>
    $(function() {
        $("#search").click(function() {
            var city = $("#city").val();
            var profession = $("#profession").val();

            if (city == "none" || profession == "none") {
                alert("Don't leave fields empty!");
                tbody = "<tr><td colspan='5'>please </td></tr>";
            } else {
                $.post('scripts/searchproviders.php', {
                    city: city,
                    profession: profession
                }, function(res) {
                    var providers = JSON.parse(res);
                    var tbody = "";

                    if (providers.failed == true) {
                        tbody = "<tr><td colspan='5'>No Service Providers found...</td></tr>";
                    } else {
                        providers.forEach(function(provider, i) {
                            tbody += "<tr>" +
                                "<td><img style='height:150px' src='images/" + provider
                                .photo +
                                "'/></td>" +
                                "<td>" + provider.name + "</td>" +
                                "<td>" + provider.adder1 + ",<br>" + provider.adder2 +
                                ",<br>" +
                                provider.city + "</td>" +
                                "<td>" + provider.profession + "</td>" +
                                "<td><a href='booking.php?provider=" + provider.id +
                                "' class='btn btn-primary btn-block'>Book</a></td>";
                        });
                    }
                    $("#providers tbody").html(tbody);
                });
            }
        });
    });
</script>

<?php include_once "./include/footer.php";
