<script>
   import Load from "$lib/components/Load.svelte";
   import PostForm from "$lib/components/PostForm.svelte";
   import Post from "$lib/components/Post.svelte";
   import CommentForm from "$lib/components/CommentForm.svelte";
   import Comment from "$lib/components/Comment.svelte";

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

<section>
   <!-- Rendera flödet  -->
   <h2>hello there- karma</h2>
</section>

<style lang="scss">
   section {
      max-width: 540px;

      hr {
         margin-bottom: 16px;
         margin-top: 8px;
      }

      div {
         border-left: 2px solid green;
      }
   }
</style>
