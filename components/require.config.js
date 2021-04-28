var components = {
    "packages": [
        {
            "name": "greensock-js",
            "main": "greensock-js-built.js"
        }
    ],
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}