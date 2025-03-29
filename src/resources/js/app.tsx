import React, { useEffect } from 'react';
import ReactDOM from 'react-dom/client'; // React 18 では `react-dom/client` を使う
import Sidebar from './components/Sidebar';

const App: React.FC = () => {
    
    return (
        <div>
            <Sidebar />
        </div>
    );
};

// React 18 のレンダリング方法
const container = document.getElementById('app');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<App />);
}




