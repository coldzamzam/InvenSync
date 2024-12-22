/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.{html,js,jsx,ts,tsx,php}"],
  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'], // Tambahkan font Poppins
      },
    },
  plugins: [],
}
}

