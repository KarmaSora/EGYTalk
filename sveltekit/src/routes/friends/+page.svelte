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
</script>

<h1>Vänner</h1>
<section>
<Load /> <!-- mest för att visa hur den fungerar -->
</section>

<style lang="scss">
   section {
      max-width: 540px;
   }
</style>
