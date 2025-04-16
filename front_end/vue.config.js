const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    host: 'front.cc.localhost',
    port: 5173,
    proxy: {
      '/api': {
        target: 'http://api.cc.localhost',
        changeOrigin: true,
      },
    },
  }
})
