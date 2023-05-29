<script>
   import { update } from "$lib/stores/update.js";

   export let postID;

   async function addComment(e) {
      update.set(false);
      const data = new FormData(e.target);
      const url = "/api/addcomment.php";

      const respons = await fetch(url, {
         method: "post",
         credentials: "include",
         body: data,
      });
      const CommentData = await respons.json();

      update.set(true);
      console.log({$update});

   }
   
  // console.log({$update});
   $:if($update){
      location.reload();
   }

</script>

<form on:submit|preventDefault={addComment}>
   <input
      type="hidden"
      id="pidNumber"
      name="pidNumberForComment"
      bind:value={postID}
   />
   <input
      type="text"
      name="commentMsg"
      id="CommentForPost"
      placeholder="post you comment here!"
   />

   <input type="submit" name="commentButton" value="svara" />
</form>

<style lang="scss">
   form {
      display: flex;
      flex-direction: row;

      width: 100%;
      input[type="text"] {
         width: 100%;
      }

      input[type="submit"] {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-left: 2px;
         &:hover {
            background-color: darkgreen;
            color: #ffffff;
         }
      }
   }
</style>
