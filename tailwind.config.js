module.exports = {
  purge: {
    options: {
      safelist: [
          /data-theme$/,
      ]
    },
    content: [
      //'./resources/**/*.blade.php',
      //'./resources/**/*.js',
    ]

  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('daisyui')
  ],
}
