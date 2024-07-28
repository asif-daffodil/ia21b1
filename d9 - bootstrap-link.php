<?php  
    require_once "./common-files/header.php";
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-4">
                <div class="border rounded shadow p-3">
                    <form action="">
                        <div class="mb-3">
                            <input type="text" placeholder="Your Name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <label for="" class="form-check-label">
                                    Gender : 
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label for="male" class="form-check-label">
                                    <input type="radio" class="form-check-input" id="male" name="gndr" value="Male">Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label for="female" class="form-check-label">
                                    <input type="radio" name="gndr" class="form-check-input" id="female" value="Female" >Female
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <label for="" class="form-check-label">
                                    Hobbies : 
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label for="reading">
                                    <input type="checkbox" class="form-check-input" id="reading" name="hobbies[]" value="Reading">Reading
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label for="writing">
                                    <input type="checkbox" class="form-check-input" id="writing" name="hobbies[]" value="Writing">Writing
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger rounded-pill shadow btn-sm px-3 btn-outline-info text-white border-0">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8 p-4">
                <table class="table table-striped table-info table-hover">
                    <tr>
                        <th>S.N.</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>City</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Male</td>
                        <td>Kathmandu</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alex Marfee</td>
                        <td>Male</td>
                        <td>New York</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>John Doe</td>
                        <td>Male</td>
                        <td>Kathmandu</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Alex Marfee</td>
                        <td>Male</td>
                        <td>New York</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php  
    require_once "./common-files/footer.php";
?>
    