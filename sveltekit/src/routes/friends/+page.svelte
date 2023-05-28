<script>
   import Load from "$lib/components/Load.svelte";
   import { user } from "$lib/stores/user.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth.js";

   afterNavigate(async () => {
      $user = await auth();

      if (!$user.auth) {
         goto("/login");
      }
   });

   async function getusers() {
      const url = "/api/getusers.php";
      const respons = await fetch(url);
      const friendsOrUsers = await respons.json();
      return friendsOrUsers;
   }
</script>

<h1>Vänner</h1>
<section>
   {#await getusers()}
      <Load /> <!-- mest för att visa hur den fungerar -->
   {:then friends}
      {#each friends as friend}
         <p>{friend.firstname} {friend.surname}</p>
         <a href="/flow/{friend.uid}">go to user</a>
         <hr />
      {/each}
   {/await}
</section>

<style lang="scss">
   section {
      max-width: 540px;
   }
</style>
