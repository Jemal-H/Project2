import { useState } from 'react';

interface HomePageProps {
  onStart: (numTeams: number) => void;
}

function HomePage({ onStart }: HomePageProps) {
  const [numTeams, setNumTeams] = useState(2);

  return (
    <div className="min-h-screen flex items-center justify-center p-4">
      <div className="bg-black border-8 border-gray-800 rounded-3xl shadow-2xl p-12 max-w-2xl w-full animate-fadeIn">
        <h1 className="text-8xl font-bold text-center mb-12 jeopardy-title">
          Jeopardy
        </h1>
        
        <div className="space-y-8">
          <div className="flex flex-col items-center space-y-4">
            <label className="text-white text-2xl font-semibold">
              Number of Teams
            </label>
            <select
              value={numTeams}
              onChange={(e) => setNumTeams(Number(e.target.value))}
              className="bg-white text-black text-xl px-6 py-3 rounded-lg border-4 border-blue-600 focus:outline-none focus:border-blue-400 cursor-pointer w-48 text-center font-semibold"
            >
              <option value={1}>1 Team</option>
              <option value={2}>2 Teams</option>
              <option value={3}>3 Teams</option>
              <option value={4}>4 Teams</option>
            </select>
          </div>

          <div className="flex justify-center pt-4">
            <button
              onClick={() => onStart(numTeams)}
              className="bg-blue-600 hover:bg-blue-500 text-white text-3xl font-bold px-16 py-4 rounded-full border-4 border-blue-400 shadow-lg transform transition-all duration-200 hover:scale-105 active:scale-95"
            >
              Start
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

export default HomePage;
