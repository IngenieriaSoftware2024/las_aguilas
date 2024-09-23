const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/empleado/index' : './src/js/empleado/index.js',
    'js/empleado/datatable' : './src/js/empleado/datatable.js',
    'js/empleado/registro' : './src/js/empleado/registro.js',
    'js/empleado/lista' : './src/js/empleado/lista.js',
    'js/empleado/perfil' : './src/js/empleado/perfil.js',
    'js/clientes/clientes' : './src/js/clientes/clientes.js',
    'js/puesto/index': './src/js/puesto/index.js',
    'js/facturas/facturas' : './src/js/facturas/facturas.js',
    'js/turno/index': './src/js/turno/index.js',
    'js/usuario/datatable' : './src/js/usuario/datatable.js',
    'js/permiso/datatable' : './src/js/permiso/datatable.js',
    'js/login/login' : './src/js/login/login.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ]
  }
};