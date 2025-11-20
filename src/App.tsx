import { useState } from 'react';
import HomePage from './pages/HomePage';
import './App.css';

function App() {
  const [numTeams, setNumTeams] = useState<number | null>(null);

  const startGame = (teams: number) => {
    setNumTeams(teams);
    alert(`Game starting with ${teams} teams!`);
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-black">
      <HomePage onStart={startGame} />
    </div>
  );
}

export default App;
