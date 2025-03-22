/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php", // Path ke file view CI4
    "./public/**/*.html",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#6C69FF",
        inputBg: "#F4F0F0",
        hoverSidebar: "#7A77FF",
      },
    },
  },
  plugins: [],
};
