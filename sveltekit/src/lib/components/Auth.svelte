<script>
   import { user } from "$lib/stores/user.js";
   import { goto } from "$app/navigation";

   async function signIn(e) {
      // Kod!
      const data = new FormData(e.target);
      const url = "/api/auth.php";

      const response = await fetch(url, {
         method: "post",
         body: data,
      });
      const check = await response.json();
      $user = check;
      console.log("log from auth.svelte" + {$user})
      console.log({$user});

      goto("/");
   }
</script>

<form method="post" on:submit|preventDefault={signIn}>
   <label for="username">username</label>
   <input type="text" name="username" />
   <br />
   <label for="pwd">password</label>
   <input type="password" name="pwd" />
   <br />
   <input type="submit" value="Logga In" />
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
