import React from 'react';
import ReactDOM from 'react-dom';
import App from './App.jsx';

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
