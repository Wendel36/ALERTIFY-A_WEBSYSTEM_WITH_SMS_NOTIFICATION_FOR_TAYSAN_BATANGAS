<div class="modal fade" id="add_residents<?php echo $row['user_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 850px;">
            <div class="modal-content" >
            <div class="modal-header bg-light">
                <img src="images/logo.png" alt="Municipality of Taysan" style="height: 90px; width: 90px;">
                <h3 class="modal-title" style="margin-left: 10px;">Taysan, Batangas</h3>
                <h3 class="modal-title" style="position: relative; right: -240px;"> Update Information</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="alertify_backend.php" method="POST">
                <div class="form-group form1">
                    <label>First Name</label>
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">
                    <input type="text" name="fullname" class="form-control" placeholder="Enter First Name." value="<?php echo $row['fullname']; ?>"required>
                </div>
                <div class="form-group form1">
                    <label>Gender</label>
                    <input type="text" name="gender" class="form-control" list="gender" placeholder="Gender" value="<?php echo $row['gender']; ?>" required>
                        <datalist id="gender">
                            <option value="Female"></option>
                            <option value="Male"></option>
                        </datalist>
                </div>
                <div class="form-group form1">
                    <label>Contact Number</label>
                    <input type="text" name="contactnumber" class="form-control" placeholder="Enter Contact Number." value="<?php echo $row['contactnumber']; ?>" required>
                </div>
                <div class="form-group form1">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email." value="<?php echo $row['email']; ?>" required>
                </div><div class="form-group form1">
                    <label>Birth Date</label>
                    <input type="text" name="birthdate" class="form-control" placeholder="Enter Birth Date." value="<?php echo $row['birthdate']; ?>" required>
                </div><div class="form-group form1">
                    <label>Barangay</label>
                    <input type="text" name="barangay" class="form-control" placeholder="Enter Barangay." value="<?php echo $row['barangay']; ?>" required>
                </div><div class="form-group form1">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Sitio." value="<?php echo $row['password']; ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_residents_info_btn" class="btn btn-success">Save changes</button>
            </div>
            </div>
          </form>
        </div>
        </div>