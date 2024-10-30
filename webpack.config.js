const path = require("path");

const isProduction = process.env.NODE_ENV === "production";

const baseConfig = {
  entry: {
    main: path.resolve(__dirname, "./src/blocks.js"),
    post: path.resolve(__dirname, "./src/post.js"),
  },
  mode: isProduction ? "production" : "development",
  output: {
    filename: "[name].js",
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            cacheDirectory: true,
          },
        },
      },
    ],
  },
  externals: {
    react: "React",
    "react-dom": "ReactDOM",
  },
};

module.exports = isProduction
  ? baseConfig
  : {
      ...baseConfig,
      devtool: "inline-source-map",
    };
