<script>
   import { user } from "$lib/stores/user.js";
   import { goto } from "$app/navigation";

   async function signIn(e) {
      // Kod!
   }
</script>

<form on:submit|preventDefault={signIn}>

</form>

<style lang="scss">
   label {
      display: block;
   }

   input {
      width: 100%;

      &[type="submit"] {
         color: white;
         background-color: #42b72a;
         border: none;
         margin: 10px 10px 0 0;
         padding: 0.7rem;
         border-radius: 6px;

         &:hover {
            background-color: green;
         }
      }
   }
</style>
