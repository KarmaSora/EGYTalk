<script>
   /**
    * Data som kommer in i komponenten
    * <Comment comment = {...} />
    */
   export let comment;
</script>

<article>
   <!--Ändra till comment.comment_txt-->
   <h3> commnetID: {comment.cid}, {comment.firstname} {comment.surname}, {comment.date}</h3>
   <p>{comment.comments}</p>
</article>

<style>
   article {
      padding: 4px;
      background-color: white;
      margin-top: 5px;
      margin-bottom: 5px;
   }
</style>
