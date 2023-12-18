import defaultTheme from "tailwindcss/defaultTheme";
import typography from "@tailwindcss/typography";

/** @type {import("tailwindcss").Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans]
            },
            keyframes: {
                ticker: {
                    "0%": {transform: "translateX(0%)"},
                    "100%": {transform: "translateX(-100%)"}
                },
                wiggle: {
                    "0%, 100%": {transform: "rotate(-3deg)"},
                    "50%": {transform: "rotate(3deg)"}
                },
                slideUp: {
                    "0%": {transform: "translateY(-100%)"},
                    "100%": {transform: "translateY(0)"}
                },
                fadeIn: {
                    "0%": {opacity: "0"},
                    // "50%": { opacity: "1" },
                    // "75%": { opacity: ".8" },
                    "100%": {opacity: "1"}
                },
                zoom: {
                    "0%": {transform: "scale(1)"},
                    "100%": {transform: "scale(1.15)"}
                }
            },
            animation: {
                wiggle: "wiggle 1s ease-in-out infinite",
                slideUp: "slideUp 20s ease-in-out infinite",
                fadeIn: "fadeIn 3s ease infinite",
                zoom: "zoom 3s ease-in-out forwards",
                ticker: "ticker 500s linear infinite",
                'ticker-slow': "ticker 1000s linear infinite"
            }
        }
    },

    plugins: [require("@tailwindcss/forms"), typography, require("@tailwindcss/aspect-ratio")]
};
