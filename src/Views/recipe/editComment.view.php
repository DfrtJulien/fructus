<?php

require_once(__DIR__ . "/../partials/headerOrange.php");

?>

<setcion class="edditCommentContainer">

  <div class="editNoteAndRating">
    <h3>Modifier son commentaire</h3>
    <form method="POST">
      <label for="note">Modifier sa note</label>
      <select name="note" id="note">
        <option value="<?= $myComment->getRating() ?>"><?= $myComment->getRating() ?></option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <?php
      if (isset($this->arrayError['note'])) {
      ?>
        <div class="alert alert-danger" role="alert">
          <p class='text-danger'><?= $this->arrayError['note'] ?></p>
        </div>
      <?php
      } ?>
      <label for="comment">Modifier son commentaire :</label>
      <textarea name="comment" id="comment"><?= $myComment->getContent() ?></textarea>
      <?php
      if (isset($this->arrayError['comment'])) {
      ?>
        <div class="alert alert-danger" role="alert">
          <p class='text-danger'><?= $this->arrayError['comment'] ?></p>
        </div>
      <?php
      } ?>
      <button type="submit" class="addComentBtn">Modifier</button>
    </form>
  </div>

</setcion>

<?php

require_once(__DIR__ . "/../partials/footer.php");
