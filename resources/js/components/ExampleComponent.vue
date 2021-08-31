<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Example Component</div>

                  <div class="card-body">
                    I'm an example component.
                  </div>
                  <div v-if="loading" class="spinner-border"></div>
                  <div v-else class="card-body">
                    {{ text }}
                  </div>
                  <button type="button" class="btn btn-danger" @click="resetText">文字列リセット</button>
                  <button type="button" class="btn btn-primary" @click="doAjaxRequest">Ajax 実行</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">

export default {
  data() {
    return {
      loading: false,
      text: 'デフォルト文字列',
    }
  },
  methods: {
    resetText() {
      this.text = '文字列リセット完了';
    },
    doAjaxRequest() {
      this.loading = true;
      axios.get('/ajax/request')
          .then((result: AxiosResponse<{ ajax_result: string }>) => {
            console.log(result);
            this.text = result.data?.ajax_result ?? '';
          })
          .catch(() => this.text = '文字列取得失敗')
          .finally(() => this.loading = false);
    },
  },
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
