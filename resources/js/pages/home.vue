<template>
<div class="row px-2">
	<!-- Blog Entries Column -->
	<div class="col-12 col-lg-8 mx-auto mt-4">
    <card :title="$t('home')">
      {{ $t('you_are_logged_in') }}
    </card>
	</div>
</div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
