const theme = process.env.WP_DEFAULT_THEME;

module.exports = {
  mode: 'jit',
  purge: {
    content: [
      `./public/themes/${theme}/**/*.php`,
      `./resources/styles/**/*.scss`,
    ],
    safelist: [
      'aspect-h-1',
      'aspect-w-1',
      'aspect-h-9',
      'aspect-w-16',
      'rounded-2xl'
    ]
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          '2xl': 0
        }
      },
      fontFamily: {
        'display': '"Inter", sans-serif',
        'title': '"Bebas Neue", sans-serif'
      },
      colors: {
        orange: '#E16A43',
        yellow: '#F0DA61',
        green: '#2AAEA2',
        dark: '#072440',
        light: '#FFFAE5'
      },
      borderWidth: {
        '3': '3px'
      }
    },
  },
  variants: {
    extend: {
      scale: ['group-hover'],
    }
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}
