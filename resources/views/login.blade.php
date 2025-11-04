import React from "react";

export default function Login() {
  return (
    <div className="flex min-h-screen">
      {/* Left Section */}
      <div className="w-1/2 bg-green-900 bg-opacity-70 text-white flex flex-col justify-center px-16 relative bg-cover bg-center"
           style={{ backgroundImage: "url('/images/farm-bg.jpg')" }}>
        <div className="absolute inset-0 bg-green-900/70"></div>
        <div className="relative z-10">
          <h1 className="text-3xl font-bold mb-2 flex items-center gap-2">
            🌱 LadangQu Forum
          </h1>
          <p className="text-gray-200 mb-6">Platform Diskusi Pertanian Indonesia</p>

          <ul className="space-y-3 text-sm">
            <li>🌾 Bergabung dengan komunitas petani se-Indonesia</li>
            <li>💬 Berbagi pengalaman dan tips pertanian</li>
            <li>👨‍🌾 Tanya jawab dengan ahli pertanian</li>
            <li>📈 Update harga komoditas terkini</li>
          </ul>
        </div>
      </div>

      {/* Right Section */}
      <div className="w-1/2 flex items-center justify-center bg-gradient-to-br from-lime-50 to-green-50">
        <div className="bg-white shadow-xl rounded-2xl p-10 w-[400px]">
          <h2 className="text-2xl font-semibold text-gray-800 mb-2">
            Masuk ke Akun Anda
          </h2>
          <p className="text-gray-500 text-sm mb-6">
            Mari bergabung dengan kami dalam diskusi pertanian
          </p>

          <form>
            <div className="mb-4">
              <label className="block text-sm font-medium text-gray-700">
                Email atau Username
              </label>
              <input
                type="text"
                placeholder="Masukkan email atau username"
                className="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"
              />
            </div>

            <div className="mb-4">
              <label className="block text-sm font-medium text-gray-700">
                Password
              </label>
              <div className="relative">
                <input
                  type="password"
                  placeholder="Masukkan password"
                  className="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-green-500 focus:border-green-500"
                />
                <span className="absolute right-3 top-2.5 text-gray-400 cursor-pointer">
                  👁️
                </span>
              </div>
            </div>

            <div className="flex items-center justify-between text-sm mb-4">
              <label className="flex items-center space-x-2">
                <input type="checkbox" className="accent-green-600" />
                <span>Ingat saya</span>
              </label>
              <a href="#" className="text-green-600 hover:underline">
                Lupa password?
              </a>
            </div>

            <button
              type="submit"
              className="w-full bg-green-600 hover:bg-green-700 text-white rounded-md py-2 mb-4 transition"
            >
              Masuk →
            </button>

            <div className="text-center text-gray-400 text-sm mb-3">atau masuk dengan</div>

            <div className="flex justify-center gap-4 mb-5">
              <button className="flex items-center border border-gray-300 rounded-md px-4 py-2 text-sm hover:bg-gray-50">
                <img src="/images/google.svg" alt="Google" className="w-4 h-4 mr-2" />
                Google
              </button>
              <button className="flex items-center border border-gray-300 rounded-md px-4 py-2 text-sm hover:bg-gray-50">
                <img src="/images/facebook.svg" alt="Facebook" className="w-4 h-4 mr-2" />
                Facebook
              </button>
            </div>

            <div className="text-center text-sm">
              Belum punya akun?{" "}
              <a href="/register" className="text-green-600 font-medium hover:underline">
                Daftar sekarang
              </a>
            </div>

            <div className="text-center text-xs text-gray-400 mt-3">
              Butuh bantuan? <a href="#" className="underline">Hubungi Support</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
