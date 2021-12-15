module.exports = {
    verbose: true,
    moduleFileExtensions: [
        "js",
        "json",
        "vue"
    ],
    moduleNameMapper: {
        "^@/(.*)$": "<rootDir>/resources/js/$1"
    },
    roots: [
        "<rootDir>/resources/js/tests"
    ],
    transform: {
        ".*\\.(vue)$": "vue-jest",
        "^.+\\.js$": "<rootDir>/node_modules/babel-jest"
    },
    collectCoverage: true,
    coverageReporters: [
        "html",
        "text-summary"
    ],
    testEnvironment: "jsdom",
}
