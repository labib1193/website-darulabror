<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = Contact::where('status', 'unread')->count();

        return view('admin.contact.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);

        // Mark as read if not already read
        if (!$contact->isRead()) {
            $contact->markAsRead();
        }

        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Mark as read
     */
    public function markAsRead(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil ditandai sebagai sudah dibaca.'
        ]);
    }

    /**
     * Mark multiple as read
     */
    public function markAllAsRead()
    {
        Contact::where('status', 'unread')->update([
            'status' => 'read',
            'read_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Semua pesan berhasil ditandai sebagai sudah dibaca.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus.'
        ]);
    }

    /**
     * Delete multiple contacts
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids');
        Contact::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan yang dipilih berhasil dihapus.'
        ]);
    }
}
