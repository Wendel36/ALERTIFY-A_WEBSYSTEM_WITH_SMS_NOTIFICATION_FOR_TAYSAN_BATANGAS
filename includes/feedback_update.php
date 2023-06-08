
<!-- Modal -->
<div class="modal fade" id="feedbackModal<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="max-width: 850px;">
    <div class="modal-content">
    <div class="modal-header bg-light">
                <img src="images/logo.png" alt="Municipality of Taysan" style="height: 90px; width: 90px;">
                <h3 class="modal-title" style="margin-left: 10px;">Taysan, Batangas</h3>
                <h3 class="modal-title" style="position: relative; right: -240px;">Feedback Section</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      <div class="modal-body">
        <form action="alertify_backend.php" method="POST">
      <div class="form-group mb-3">
      <label>Email</label>
        <input type="email"  name="email" class="form-control" placeholder="Email" aria-label="Email" value="<?php echo $row['email'];?>"readonly>
     </div>
      <div class="form-group mb-3">
      <label>Feedbacks</label>
        <textarea class="form-control" aria-label="With textarea" placeholder="Feedback" rows="4" readonly><?php echo $row['feedback'];?></textarea>
        </div>
        <div class="input-group">
        <textarea class="form-control" name="response" aria-label="With textarea" rows="5" placeholder="Enter your Reply"></textarea>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="send_response">Send</button>
      </div>
      </form>
    </div>
  </div>
</div>