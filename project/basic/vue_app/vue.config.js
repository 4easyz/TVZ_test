const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  configureWebpack: (config) => {
    const devWatchOptions = {
        aggregateTimeout: 200,
        poll: 100,
        ignored: ['node_modules']
    }
    const renderWatchOptions = () => process.env.NODE_ENV === 'development' ? devWatchOptions : {}
    config.watchOptions = renderWatchOptions()
  }
})
