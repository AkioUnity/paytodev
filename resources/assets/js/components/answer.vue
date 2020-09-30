<template>
  <tr>
    <td>{{customer.name}}</td>
    <td>{{customer.email}}</td>
  </tr>
</template>

<script>
export default {
  props:['customer']
}
</script>

<style>

</style>
