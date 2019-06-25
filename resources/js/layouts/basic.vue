<template>
  <div class="basic-layout d-flex m-0 p-4 bg-white">
    <!--  d-flex align-items-center justify-content-center -->
    <child />
  </div>
</template>

<script>
export default {
  name: 'BasicLayout'
}
</script>

<style lang="scss">
.basic-layout {
  color: #636b6f;
  min-height: 100vh;
  font-weight: 100;
  position: relative;

  .links > a {
    color: #636b6f;
    padding: 10px 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
  .links > a:hover {
    color: #111;
  }
}
</style>
