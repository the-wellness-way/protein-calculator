// build/webpack.config.js
import path from 'path';
import { fileURLToPath } from 'url';

// Define __dirname manually
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  entry: {
    index: path.resolve(__dirname, '../../js/index.js'),
    //shortcode: path.resolve(__dirname, '../assets/js/shortcodes/shortcode.js'),
  },
  output: {
    filename: '[name].bundle.js', // Output bundle names will be index.bundle.js and shortcode.bundle.js
    path: path.resolve(__dirname, '../dist'), // Output directory
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js'],
  },
};
