<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
  mounted() {
    const greet: string = 'Hello TypeScript';
    type IsTypeScript = 'TypeScript';
    console.log('Component mounted.');
    const isTypeScript = (value: any): IsTypeScript =>
        value.includes('TypeScript')

    if (isTypeScript(greet)) {
      console.log(greet);
    }
  }
}
</script>
