module.exports = {
    env: {
      node: true, // Добавляем поддержку Node.js
    },
    parserOptions: {
      parser: '@babel/eslint-parser',
      requireConfigFile: false,
    },
    extends: [
      'plugin:vue/essential',
      'eslint:recommended',
    ],
    rules: {
    },
  };
  