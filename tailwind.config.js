/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.{html,php,blade}",
        "./resources/views/*.{html,php,blade}",
        "./resources/views/**/*.{html,php,blade}",
        "./*.{html,php,blade}"
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

