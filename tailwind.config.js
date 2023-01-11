/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    screens: {

			'2xl': {'max': '1980px'},
			'xl': {'max': '1536px'},	  
			'lg': {'max': '1023px'},
			'md': {'max': '767px'},
			'sm': {'max': '639px'},
		  },
    extend: {},
  },
  plugins: [],
}
