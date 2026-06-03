<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $stats = [
            'total'    => PurchaseRequest::where('requested_by', Auth::id())->count(),
            'pending'  => PurchaseRequest::where('requested_by', Auth::id())->where('status', 'Pending')->count(),
            'approved' => PurchaseRequest::where('requested_by', Auth::id())->where('status', 'Approved')->count(),
            'rejected' => PurchaseRequest::where('requested_by', Auth::id())->where('status', 'Rejected')->count(),
        ];

       $recent = PurchaseRequest::with('user')->where('requested_by', Auth::id())->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent'));
    }

    public function index(Request $request)
    {
         $query = PurchaseRequest::with('user')->where('requested_by', Auth::id());

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('pr_no', 'like', '%' . $request->search . '%');
        }

        $purchaseRequests = $query->latest()->paginate(10)->withQueryString();

        return view('purchase-requests.index', compact('purchaseRequests'));
    }

    public function create()
    {
        return view('purchase-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pr_no'       => 'required|unique:purchase_requests,pr_no|max:50',
            'title'       => 'required|max:255',
            'description' => 'required',
            'status'      => 'required|in:Pending,Approved,Rejected',
        ], [
            'pr_no.required'       => 'PR Number is required.',
            'pr_no.unique'         => 'This PR Number already exists.',
            'pr_no.max'            => 'PR Number cannot exceed 50 characters.',
            'title.required'       => 'Title is required.',
            'title.max'            => 'Title cannot exceed 255 characters.',
            'description.required' => 'Description is required.',
            'status.required'      => 'Status is required.',
            'status.in'            => 'Status must be Pending, Approved, or Rejected.',
        ]);

        $validated['requested_by'] = Auth::id();

        PurchaseRequest::create($validated);

        return redirect()->route('purchase-requests.index')
                         ->with('success', 'Purchase Request created successfully!');
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->load('user');
        return view('purchase-requests.show', compact('purchaseRequest'));
    }

    public function edit(PurchaseRequest $purchaseRequest)
    {
        return view('purchase-requests.edit', compact('purchaseRequest'));
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $validated = $request->validate([
            'pr_no'       => 'required|unique:purchase_requests,pr_no,'
                             . $purchaseRequest->id . '|max:50',
            'title'       => 'required|max:255',
            'description' => 'required',
            'status'      => 'required|in:Pending,Approved,Rejected',
        ], [
            'pr_no.required'       => 'PR Number is required.',
            'pr_no.unique'         => 'This PR Number already exists.',
            'title.required'       => 'Title is required.',
            'description.required' => 'Description is required.',
            'status.required'      => 'Status is required.',
        ]);

        $purchaseRequest->update($validated);

        return redirect()->route('purchase-requests.index')
                         ->with('success', 'Purchase Request updated successfully!');
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->delete();

        return redirect()->route('purchase-requests.index')
                         ->with('success', 'Purchase Request deleted successfully!');
    }

    public function updateStatus(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $purchaseRequest->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'status'  => $purchaseRequest->status,
        ]);
    }

    public function apiIndex(Request $request)
    {
        $query = PurchaseRequest::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('pr_no', 'like', '%' . $request->search . '%');
        }

        $purchaseRequests = $query->latest()->get();

        return response()->json([
            'success' => true,
            'total'   => $purchaseRequests->count(),
            'data'    => $purchaseRequests,
        ]);
    }

    public function apiShow(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->load('user');

        return response()->json([
            'success' => true,
            'data'    => $purchaseRequest,
        ]);
    }
}