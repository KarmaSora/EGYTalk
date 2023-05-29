<script>
   import { update } from "$lib/stores/update.js";

   let result = { success: true };

   async function addPost(e) {
      update.set(false);
      const data = new FormData(e.target);
      const url = "/api/addpost.php";

      const respons = await fetch(url, {
         method: "post",
         credentials: "include",
         body: data,
      });
      const PostData = await respons.json();

      console.log({ respons });
      console.log({ PostData });
      update.set(true);
      console.log({$update});

   }
   console.log({$update});
   $:if($update){
      location.reload();
   }
</script>

<form on:submit|preventDefault={addPost}>
   <h1>post a new msg</h1>

   <textarea
      name="postMsg"
      id="PostTextArea"
      placeholder="post your comment here!"
      cols="30"
      rows="10"
   />

   <button type="submit">postMessage</button>
</form>

<style lang="scss">
   form {
      text-align: right;
      max-width: 540px;

      h1 {
         text-align: left;
      }

      textarea {
         width: 100%;
         height: 10rem;
         vertical-align: top;
         border: 1px solid rgb(124, 10, 10);
         border-radius: 6px;
         resize: none;
         padding: 0.5rem;
      }

      p {
         display: inline-block;
         color: red;
         font-weight: bold;
         margin-right: 1rem;
      }

      button {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: #42b72a;
         margin-top: 0.2rem;

         &:enabled:hover {
            background-color: green;
            color: #ffffff;
         }

         &:enabled:active {
            background-color: rgb(4, 50, 4);
            color: #aeaeae;
         }

         &:disabled {
            background-color: lightgrey;
         }
      }
   }
</style>
