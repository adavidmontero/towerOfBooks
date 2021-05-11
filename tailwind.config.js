module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {},
    fontFamily: {
      'logo': ['"Cookie"', 'cursive'],
      'titles': ['"Work Sans"', 'sans-serif'],
      'bodies' : ['"Bitter"', 'serif']
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
