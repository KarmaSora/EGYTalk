<script>
   import { update } from "$lib/stores/update.js";

   export let postID;

   async function addComment(e) {
   }
</script>

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
